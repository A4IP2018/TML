<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\File;
use App\Match;
use Storage;
use App\Comparison;
use Illuminate\Support\Facades\File as FileSys;

class CompareUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batch_id;
    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_files = File::where('batch_id', $this->batch_id)->groupBy('requirement_id')->get();
        if (is_null($user_files)) return;

        $homework = $user_files[0]->first()->homework;
        $upload_dir = config('app.upload_dir');

        foreach ($user_files as $requirement) {
            $requirement_dir_name = $homework->slug . '_' . $requirement->requirement_id;
            $all_homework_files = $homework->files->where('requirement_id', $requirement->requirement_id);

            $temp_folder = 'app/comparisons/' . $requirement_dir_name;
            $temp_dir = 'comparisons/' . $requirement_dir_name;
            $temp_folder_full = storage_path($temp_folder);
            $current_file_full = storage_path('app/' . $requirement->storage_path);

            if (!is_dir($temp_folder_full))
            {
                FileSys::makeDirectory($temp_folder_full);
                foreach ($all_homework_files as $file) {
                    $name = basename($file->storage_path);
                    dd(storage_path('app/' . $file->storage_path), $temp_folder_full . '/' . $name);
                    if (!FileSys::exists($temp_folder_full . '/' . $name)) {
                        FileSys::copy(storage_path('app/' . $file->storage_path), $temp_folder_full . '/' . $name);
                    }
                }
            }
            else {
                if (!FileSys::exists($temp_folder_full . '/' . basename($requirement->storage_path))) {
                    FileSys::copy(storage_path('app/' . $requirement->storage_path), $temp_folder_full . '/' . basename($requirement->storage_path));
                }

            }

            $command = sprintf("\"%s\" \"%s\"  --detailed --againstdir -d=\"%s\" ",
                app_path('Console/OSPC/OSPC.exe'),
                $current_file_full,
                $temp_folder_full
            );


            $result = shell_exec($command);
            $result = trim($result, "\n\r\t.");

            $object = json_decode(utf8_encode($result), true);
            $normalized_path_files = str_replace('\\', '/', dirname($current_file_full) . '/');
            $normalized_path_temp = str_replace('\\', '/', $temp_folder_full . '/');

            if (is_null($object)) return;

            foreach ($object['results'] as $result) {
                $file_name_1 = config('app.upload_dir') . '/' . str_replace($normalized_path_files, '', $result['fileA']);
                $file_name_2 = config('app.upload_dir') . '/' . str_replace($normalized_path_temp, '', $result['fileB']);

                $file_1 = File::where('storage_path', $file_name_1)->first();
                $file_2 = File::where('storage_path', $file_name_2)->first();
                if (is_null($file_1) or is_null($file_2)) continue;
                if ($file_1->user->id == $file_2->user->id) continue;

                $comparison = Comparison::updateOrCreate(
                    [
                        'file_id_1' => $file_1->id,
                        'file_id_2' => $file_2->id
                    ],
                    [
                        'file_id_1' => $file_1->id,
                        'file_id_2' => $file_2->id,
                        'homework_id' => $homework->id,
                        'requirement_id' => $requirement->requirement_id,
                        'match_count' => $result['matchCount'],
                        'token_count' => $result['tokenCount'],
                        'similarityA' => $result['simmA'],
                        'similarityB' => $result['simmB']
                    ]
                );

                $matchesComp = [
                    [
                        'side' => 'A',
                        'arr' => $result['matchesA']
                    ],
                    [
                        'side' => 'B',
                        'arr' => $result['matchesB']
                    ]
                ];

                foreach ($matchesComp as $matchArr) {
                    foreach ($matchArr['arr'] as $match) {
                        Match::updateOrCreate(
                            [
                                'comparison_id' => $comparison->id,
                                'side' => $matchArr['side'],
                                'start' => $match['start']
                            ],
                            [
                                'comparison_id' => $comparison->id,
                                'side' => $matchArr['side'],
                                'start' => $match['start'],
                                'length' => $match['length']
                            ]
                        );
                    }
                }
            }
        }
    }
}
