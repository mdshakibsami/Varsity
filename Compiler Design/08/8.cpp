/*
 * 08 Write a C++ program to implement NFA that recognize identifiers
 */

#include <bits/stdc++.h>
using namespace std;

// Function to simulate NFA
bool isIdentifier(const string &s)
{
    int state = 0; // Start state q0

    for (char ch : s)
    {
        switch (state)
        {
        case 0: // Start state
            if (isalpha(ch) || ch == '_')
                state = 1; // valid first char
            else
                return false; // invalid first char
            break;

        case 1: // Accepting state q1
            if (isalnum(ch) || ch == '_')
                state = 1; // stay in q1
            else
                return false; // invalid char
            break;
        }
    }

    return (state == 1); // Accept if in q1
}

int main()
{
    string str;
    cout << "Enter a string: ";
    cin >> str;

    if (isIdentifier(str))
        cout << "Valid Identifier" << endl;
    else
        cout << "Invalid Identifier" << endl;

    return 0;
}
