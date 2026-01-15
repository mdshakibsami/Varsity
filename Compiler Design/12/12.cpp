/**
 * PROBLEM: Write a C++ program to find FOLLOW values from a given set of productions
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
map<string, set<string>> followSet;
string startSymbol;

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

/* Get FIRST of a string of symbols */
set<string> getFirstOfString(string str)
{
    set<string> result;

    for (int i = 0; i < str.length();)
    {
        string currentSymbol;

        // Handle "id" as single terminal
        if (i + 1 < str.length() && str[i] == 'i' && str[i + 1] == 'd')
        {
            currentSymbol = "id";
            i += 2;
        }
        // Handle E' or T' as single symbols
        else if (i + 1 < str.length() && str[i + 1] == '\'')
        {
            currentSymbol = str.substr(i, 2);
            i += 2;
        }
        else
        {
            currentSymbol = string(1, str[i]);
            i++;
        }

        // If terminal, add it and stop
        if (isTerminal(currentSymbol))
        {
            result.insert(currentSymbol);
            return result;
        }

        // If non-terminal, add its FIRST (except epsilon)
        bool hasEpsilon = false;
        for (string f : firstSet[currentSymbol])
        {
            if (f == "e")
                hasEpsilon = true;
            else
                result.insert(f);
        }

        // If no epsilon, stop
        if (!hasEpsilon)
            return result;
    }

    // All symbols derive epsilon
    result.insert("e");
    return result;
}

/* Function to find FOLLOW */
void findFollow(string symbol)
{
    // Add $ to start symbol
    if (symbol == startSymbol)
        followSet[symbol].insert("$");

    // Check all productions
    for (auto prod : grammar)
    {
        string lhs = prod.first;

        for (string rhs : prod.second)
        {
            // Find symbol in RHS
            for (int i = 0; i < rhs.length();)
            {
                string currentSymbol;

                // Handle "id" as single terminal
                if (i + 1 < rhs.length() && rhs[i] == 'i' && rhs[i + 1] == 'd')
                {
                    currentSymbol = "id";
                    i += 2;
                }
                // Handle E' or T' as single symbols
                else if (i + 1 < rhs.length() && rhs[i + 1] == '\'')
                {
                    currentSymbol = rhs.substr(i, 2);
                    i += 2;
                }
                else
                {
                    currentSymbol = string(1, rhs[i]);
                    i++;
                }

                // If this is the symbol we're finding FOLLOW for
                if (currentSymbol == symbol && !isTerminal(currentSymbol))
                {
                    // Get what comes after this symbol
                    string beta = rhs.substr(i);

                    if (beta.empty())
                    {
                        // Symbol is at end, add FOLLOW(lhs)
                        if (lhs != symbol)
                        {
                            for (string f : followSet[lhs])
                                followSet[symbol].insert(f);
                        }
                    }
                    else
                    {
                        // Get FIRST(beta)
                        set<string> firstOfBeta = getFirstOfString(beta);

                        bool hasEpsilon = false;
                        for (string f : firstOfBeta)
                        {
                            if (f == "e")
                                hasEpsilon = true;
                            else
                                followSet[symbol].insert(f);
                        }

                        // If epsilon in FIRST(beta), add FOLLOW(lhs)
                        if (hasEpsilon && lhs != symbol)
                        {
                            for (string f : followSet[lhs])
                                followSet[symbol].insert(f);
                        }
                    }
                }
            }
        }
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

    // Set start symbol (first non-terminal)
    startSymbol = grammar.begin()->first;

    // Compute FIRST for each non-terminal
    for (auto g : grammar)
        findFirst(g.first);

    // Compute FOLLOW (iterate multiple times for dependencies)
    for (int iteration = 0; iteration < 5; iteration++)
    {
        for (auto g : grammar)
            findFollow(g.first);
    }

    // Print FOLLOW sets
    cout << "FOLLOW sets:\n";
    for (auto g : grammar)
    {
        cout << "FOLLOW(" << g.first << ") = { ";
        for (string c : followSet[g.first])
            cout << c << " ";
        cout << "}\n";
    }

    return 0;
}
