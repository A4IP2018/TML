<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\File;
use Illuminate\Support\Facades\File as FileSystem;

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

        foreach ($user_files as $requirement) {
            $all_homework_files = $homework->files->where('requirement_id', $requirement->requirement_id);

            $temp_folder = public_path('compare/' . generate_random_string(20));
            FileSystem::makeDirectory($temp_folder);
            foreach ($all_homework_files as $file) {
                $old_file = public_path('files/' . $file->file_name);
                $new_file = $temp_folder . '/' . $file->file_name;
                FileSystem::copy($old_file, $new_file);
            }

            $command = sprintf("\"%s\" \"%s\"  --detailed --againstdir -d=\"%s\" ",
                app_path('Console/OSPC/OSPC.exe'),
                public_path('files/' . $requirement->file_name),
                $temp_folder
            );

            $result = shell_exec($command);
            $result = trim($result, "\n\r\t.");
            FileSystem::deleteDirectory($temp_folder);

            $object = json_decode(utf8_encode($result), true);
            if (is_null($object)) continue;
            foreach ($object['results'] as $result) {
                // Do something
            }
        }
    }
}
