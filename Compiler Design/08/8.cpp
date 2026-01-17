/*
 * PROBLEM: 08 Write a C++ program to implement NFA that recognize identifiers
 */

#include <bits/stdc++.h>
using namespace std;

bool isValidIdentifier(string word)
{
    int state = 0;

    for (auto ch : word)
    {
        switch (state)
        {
        case 0:
            if (isalpha(ch) || ch == '_')
                state = 1;
            else
                return false;
            break;

        case 1:
            if (isalnum(ch) || ch == '_')
                state = 1;
            else
                return false;
            break;
        }
    }

    return (state == 1);
}

int main()
{
    ifstream file;
    string identifier;
    file.open("input.txt");
    file >> identifier;
    file.close();

    if (isValidIdentifier(identifier))
        cout
            << identifier << " is valid" << endl;
    else
        cout << identifier << " is not valid" << endl;
}
