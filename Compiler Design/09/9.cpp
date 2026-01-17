/**
 * PROBLEM: 09: Write a cpp program to implement DFA that recognized identifiers, constant and operators

 Testcase :
    _sum
    2value
    10
    +
    +=
    $value
 **/

#include <iostream>
#include <string>
#include <cctype>
using namespace std;

int main()
{
    string s;
    cout << "Enter a string: ";
    cin >> s;

    int state = 0;

    for (char ch : s)
    {
        switch (state)
        {
        // Start state
        case 0:
            if (isalpha(ch) || ch == '_')
                state = 1; // Identifier
            else if (isdigit(ch))
                state = 2; // Constant
            else if (ch == '+' || ch == '-' || ch == '*' ||
                     ch == '/' || ch == '=' || ch == '<' || ch == '>')
                state = 3; // Operator
            else
                state = -1;
            break;

        // Identifier state
        case 1:
            if (isalnum(ch) || ch == '_')
                state = 1;
            else
                state = -1;
            break;

        // Constant state
        case 2:
            if (isdigit(ch))
                state = 2;
            else
                state = -1;
            break;

        // Operator state (check for compound operator)
        case 3:
            if (ch == '=')
                state = 4; // Compound operator
            else
                state = -1;
            break;

        // Compound operator (only two chars allowed)
        case 4:
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
    else if (state == 3 || state == 4)
        cout << "Operator" << endl;
    else
        cout << "Invalid token" << endl;

    return 0;
}
