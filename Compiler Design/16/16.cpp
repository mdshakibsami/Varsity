/**
 * PROBLEM: 16. Write a C++ program to eliminate left recursion for a given grammar
 */

#include <bits/stdc++.h>
using namespace std;

int main()
{
    ifstream file("input.txt");
    if (!file)
    {
        cout << "Error: input.txt not found\n";
        return 0;
    }

    int n;
    file >> n; // number of non-terminals

    map<char, vector<string>> grammar;
    for (int i = 0; i < n; i++)
    {
        char nt;
        int p;
        file >> nt >> p; // Non-terminal and number of productions
        vector<string> prods;
        for (int j = 0; j < p; j++)
        {
            string prod;
            file >> prod;
            prods.push_back(prod);
        }
        grammar[nt] = prods;
    }
    file.close();

    map<char, vector<string>> newGrammar;
    char nextNT = 'Z';

    for (auto g : grammar)
    {
        char A = g.first;
        vector<string> leftRec, nonLeftRec;

        for (auto prod : g.second)
        {
            if (prod[0] == A)
                leftRec.push_back(prod.substr(1)); // α
            else
                nonLeftRec.push_back(prod); // β
        }

        if (!leftRec.empty())
        {
            char A1 = nextNT--;
            newGrammar[A] = {};
            for (auto beta : nonLeftRec)
                newGrammar[A].push_back(beta + A1);

            newGrammar[A1] = {};
            for (auto alpha : leftRec)
                newGrammar[A1].push_back(alpha + A1);
            newGrammar[A1].push_back("e"); // epsilon
        }
        else
        {
            newGrammar[A] = g.second;
        }
    }

    /* ---------- Print Grammar ---------- */
    cout << "\nGrammar after eliminating left recursion:\n";
    for (auto g : newGrammar)
    {
        cout << g.first << " -> ";
        for (int i = 0; i < g.second.size(); i++)
        {
            cout << g.second[i];
            if (i != g.second.size() - 1)
                cout << " | ";
        }
        cout << endl;
    }

    return 0;
}
