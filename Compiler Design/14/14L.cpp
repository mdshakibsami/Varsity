/**
 * PROBLEM: 14. Write a C++ program to perform left most derivation for a given set of production
 */

#include <iostream>
#include <fstream>
#include <map>
#include <vector>
#include <string>
using namespace std;

map<char, vector<string>> grammar;
char startSymbol;

/* Check if character is non-terminal */
bool isNonTerminal(char c)
{
    return (c >= 'A' && c <= 'Z');
}

int main()
{
    ifstream file("inputL.txt");
    if (!file)
    {
        cout << "Error: input.txt not found!\n";
        return 0;
    }

    int n;
    file >> n;     // first line: number of productions
    file.ignore(); // ignore newline after the number

    for (int i = 0; i < n; i++)
    {
        string line;
        getline(file, line);

        if (line.empty())
        {
            i--;
            continue;
        } // skip empty lines

        char lhs = line[0];          // first character is LHS
        string rhs = line.substr(2); // skip " " after lhs

        grammar[lhs].push_back(rhs);
        if (i == 0)
            startSymbol = lhs; // first LHS is start symbol
    }

    file.close();

    string result;
    result += startSymbol;

    cout << "\nLeft Most Derivation:\n";
    cout << result << endl;

    while (true)
    {
        bool replaced = false;

        for (int i = 0; i < result.length(); i++)
        {
            if (isNonTerminal(result[i]))
            {
                char nt = result[i];
                string prod = grammar[nt][0]; // choose first production

                if (prod == "e") // epsilon
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
