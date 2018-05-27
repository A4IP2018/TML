// OSPC - Open Software Plagiarism Checker
// Copyright(C) 2015 Arthur Zaczek at the UAS Technikum Wien


// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program.If not, see<http://www.gnu.org/licenses/>.

using OSPC.Tokenizer;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace OSPC.Reporter
{
    public class DetailedConsoleReporter : IReporter
    {
        public void Create(Configuration cfg, OSPCResult r)
        {
            foreach (var result in r.Results)
            {
                var aReader = new StreamReader(result.A.FilePath);
                var bReader = new StreamReader(result.B.FilePath);
                var matchesA = GetMatchedStrings(result, aReader, m => m.TokensA);
                var matchesB = GetMatchedStrings(result, bReader, m => m.TokensB);



                Console.Write("{");
                Console.Write("\"{0}\":\"{1}\", \"{2}\":\"{3}\", \"{4}\":\"{5}\", \"{6}\":\"{7}\", \"{8}\":{9:n2}, \"{10}\":{11:n2}, \"{12}\" : [{13}], \"{14}\" : [{15}]",
                    "fileA",
                    result.A.FilePath,
                    "fileB",
                    result.B.FilePath,
                    "matchCount",
                    result.MatchCount,
                    "tokenCount",
                    result.TokenCount,
                    "simmA",
                    100.0 * result.SimilarityA,
                    "simmB",
                    100.0 * result.SimilarityB,
                    "matchesA",
                    BuildArrayJson(matchesA),
                    "matchesB",
                    BuildArrayJson(matchesB)
                );
                Console.WriteLine("}");
            }
        }


        public List<Tuple<int, int>> GetMatchedStrings(CompareResult result, StreamReader rd, Func<Match, LinkedList<Token>> tokenExtractor)
        {
            List<Tuple<int, int>> resultList = new List<Tuple<int, int>>();
            
            var content = rd.ReadToEnd();
            int idx = 0;
            var currentMatch = result.Matches.OrderBy(m => tokenExtractor(m).First.Value.Start).ToList().GetEnumerator();
            currentMatch.MoveNext();
            while (idx < content.Length)
            {
                int start = currentMatch.Current != null ? tokenExtractor(currentMatch.Current).First.Value.Start : content.Length;
                if (start > idx)
                {
                    // not in match
                    idx = start;
                }
                else
                {
                    int end = tokenExtractor(currentMatch.Current).Last.Value.End;
                    // in match
                    resultList.Add(new Tuple<int, int>(idx, end - idx));
                    currentMatch.MoveNext();
                    idx = end;
                }
            }
            return resultList;
        }

        public String BuildArrayJson(List<Tuple<int, int>> values)
        {
            String result = "";
            var counter = 0;
            foreach (var m in values)
            {
                result += "{";
                result += string.Format("\"start\": {0}, \"length\": {1}", m.Item1, m.Item2);
                result += "}";
                if (counter < values.Count - 1)
                {
                    result += ",";
                }
            }
            return result;
        }
    }
}
