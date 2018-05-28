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
            Console.WriteLine("{");
            Console.WriteLine("    \"results\": [");
            var resultCount = 0;
            foreach (var result in r.Results)
            {
                var aReader = new StreamReader(result.A.FilePath);
                var bReader = new StreamReader(result.B.FilePath);
                var matchesA = GetMatchedStrings(result, aReader, m => m.TokensA);
                var matchesB = GetMatchedStrings(result, bReader, m => m.TokensB);



                Console.WriteLine("        {");
                Console.WriteLine("            \"{0}\": \"{1}\",", "fileA", result.A.FilePath.Replace('\\', '/'));
                Console.WriteLine("            \"{0}\": \"{1}\",", "fileB", result.B.FilePath.Replace('\\', '/'));
                Console.WriteLine("            \"{0}\": {1},", "matchCount", result.MatchCount);
                Console.WriteLine("            \"{0}\": {1},", "tokenCount", result.TokenCount);
                Console.WriteLine("            \"{0}\": {1:n2},", "simmA", 100.0 * result.SimilarityA);
                Console.WriteLine("            \"{0}\": {1:n2},", "simmB", 100.0 * result.SimilarityB);
                Console.WriteLine("            \"{0}\": [{1}],", "matchesA", BuildArrayJson(matchesA));
                Console.WriteLine("            \"{0}\": [{1}]", "matchesB", BuildArrayJson(matchesB));
                if (resultCount == r.Results.Count - 1)
                {
                    Console.WriteLine("        }");
                }
                else
                {
                    Console.WriteLine("        },");
                }
                

                /* BuildArrayJson(matchesA),
                    "matchesB",
                    BuildArrayJson(matchesB)*/
                resultCount++;
            }
            Console.WriteLine("    ]");
            Console.WriteLine("}");
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
                counter++;
            }
            return result;
        }
    }
}
