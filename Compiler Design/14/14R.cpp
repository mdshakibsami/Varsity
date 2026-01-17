/**
 * PROBLEM: 14. Write a C++ program to perform right most derivation for a given set of production
 */

#include <bits/stdc++.h>
using namespace std;

map<char, vector<string>> grammar;
char startSymbol;

int main()
{
    ifstream file("inputR.txt");

    int n;
    file >> n;

    for (int i = 0; i < n; i++)
    {
        char lhs;
        string rhs;
        file >> lhs >> rhs;
        grammar[lhs].push_back(rhs);
        if (i == 0)
            startSymbol = lhs;
    }
    file.close();

    string result;
    result += startSymbol;

    cout << "Rightmost Derivation:\n";
    cout << result << endl;

    while (true)
    {
        bool replaced = false;
        for (int i = result.length() - 1; i >= 0; i--)
        {
            // scan **right to left**
            if (isupper(result[i]))
            {
                char nt = result[i];
                string prod = grammar[nt][0];
                if (prod == "e")
                    result.replace(i, 1, "");
                else
                    result.replace(i, 1, prod);

                cout << "=> " << result << endl;
                replaced = true;
                break;
            }
        }
        if (!replaced)
            break;
    }

    return 0;
}
