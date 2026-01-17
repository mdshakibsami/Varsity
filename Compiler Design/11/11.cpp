/**
 * PROBLEM: 11: Write a C++ program to find FIRST values from a given set of productions
 */

#include <iostream>
#include <map>
#include <set>
#include <vector>
#include <string>
#include <fstream>
#include <sstream>
using namespace std;

map<string, vector<string>> grammar;
map<string, set<string>> firstSet;

/* Check if symbol is terminal (lowercase or special char) */
bool isTerminal(string s)
{
    return !isupper(s[0]);
}

/* Function to find FIRST */
void findFirst(string symbol)
{
    // If FIRST already computed
    if (!firstSet[symbol].empty())
        return;

    for (string production : grammar[symbol])
    {
        bool epsilonPossible = true;

        // Process production symbol by symbol
        for (int i = 0; i < production.length();)
        {
            string currentSymbol;

            // Handle "id" as single terminal
            if (i + 1 < production.length() && production[i] == 'i' && production[i + 1] == 'd')
            {
                currentSymbol = "id";
                i += 2;
            }
            // Handle E' or T' as single symbols
            else if (i + 1 < production.length() && production[i + 1] == '\'')
            {
                currentSymbol = production.substr(i, 2);
                i += 2;
            }
            else
            {
                currentSymbol = string(1, production[i]);
                i++;
            }

            // If terminal
            if (isTerminal(currentSymbol))
            {
                firstSet[symbol].insert(currentSymbol);
                epsilonPossible = false;
                break;
            }
            // If non-terminal
            else
            {
                findFirst(currentSymbol);

                bool hasEpsilon = false;
                for (string f : firstSet[currentSymbol])
                {
                    if (f == "e")
                        hasEpsilon = true;
                    else
                        firstSet[symbol].insert(f);
                }

                if (!hasEpsilon)
                {
                    epsilonPossible = false;
                    break;
                }
            }
        }

        // If all symbols can derive epsilon
        if (epsilonPossible)
            firstSet[symbol].insert("e");
    }
}

int main()
{
    ifstream file("input.txt");

    if (!file.is_open())
    {
        cout << "Error: input.txt file not found!" << endl;
        return 0;
    }

    int n;
    file >> n;
    file.ignore(); // Ignore newline after number

    for (int i = 0; i < n; i++)
    {
        string line;
        getline(file, line);

        // Parse line: "E TE'" -> lhs="E", rhs="TE'"
        stringstream ss(line);
        string lhs, rhs;
        ss >> lhs >> rhs;

        grammar[lhs].push_back(rhs);
    }

    file.close();

    // Compute FIRST for each non-terminal
    for (auto g : grammar)
        findFirst(g.first);

    // Print FIRST sets
    cout << "FIRST sets:\n";
    for (auto g : firstSet)
    {
        cout << "FIRST(" << g.first << ") = { ";
        for (string c : g.second)
            cout << c << " ";
        cout << "}\n";
    }

    return 0;
}
