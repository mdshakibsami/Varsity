/**
 * PROBLEM: 09: Write a cpp program to implement DFA that recognized identifiers, constant and operators
 */

#include <bits/stdc++.h>
using namespace std;

int main()
{
    ifstream file;
    string word;
    file.open("input.txt");
    file >> word;
    file.close();

    int state = 0;
    for (auto ch : word)
    {
        switch (state)
        {
        case 0:
            if (isalpha(ch) || ch == '_')
                state = 1;
            else if (isdigit(ch))
                state = 2;
            else if (ch == '*' ||
                     ch == '/' || ch == '=' || ch == '<' || ch == '>')
                state = 3;
            else if (ch == '+' || ch == '-')
                state = 4;
            else
                state = -1;
            break;

        case 1:
            if (isalnum(ch) || ch == '_')
                state = 1;
            else
                state = -1;
            break;
        case 2:
            if (isdigit(ch))
                state = 2;
            else
                state = -1;
            break;
        case 3:
            if (ch == '=')
                state = 5;
            else
                state = -1;
            break;
        case 4:
            if (ch == '+' || ch == '-' || ch == '=')
                state = 5;
            else
                state = -1;
            break;
        case 5:
            state = -1;
            break;
        }

        if (state == -1)
            break;
    }

    if (state == 1)
        cout << "Identifier" << endl;
    else if (state == 2)
        cout << "Constant" << endl;
    else if (state == 3 || state == 4 || state == 5)
        cout << "Operator" << endl;
    else
        cout << "Invalid" << endl;
}
