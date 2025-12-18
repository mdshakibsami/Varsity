/*
 * 04 Write a C++ program to test whether a given identifier is valid or not.
 */

#include <bits/stdc++.h>
using namespace std;

int main()
{
    string id;
    cout << "Enter an identifier: ";
    cin >> id;

    set<string> keywords = {
        "auto", "break", "case", "char", "const", "continue", "default",
        "do", "double", "else", "enum", "extern", "float", "for", "goto",
        "if", "int", "long", "register", "return", "short", "signed",
        "sizeof", "static", "struct", "switch", "typedef", "union",
        "unsigned", "void", "volatile", "while"};

    bool valid = true;

    // Check keyword
    if (keywords.count(id))
    {
        valid = false;
    }

    // Check first character (only _ and alphabet)
    else if (!(isalpha(id[0]) || id[0] == '_'))
    {
        valid = false;
    }

    // Check remaining characters
    else
    {
        for (int i = 1; i < id.length(); i++)
        {
            if (!(isalnum(id[i]) || id[i] == '_'))
            {
                valid = false;
                break;
            }
        }
    }

    if (valid)
        cout << "Valid identifier" << endl;
    else
        cout << "Invalid identifier" << endl;

    return 0;
}
