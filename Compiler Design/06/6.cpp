/*
 * 06 Write a C++ program to simulate lexical analyzer for validating operators.
 */

#include <bits/stdc++.h>
using namespace std;

int main()
{
    string op;
    cout << "Enter an operator: ";
    cin >> op;

    set<string> operators = {
        "+", "-", "*", "/", "%", "=",
        "==", "!=", "<", ">", "<=", ">=",
        "&&", "||", "!",
        "+=", "-=", "*=", "/=", "%="};

    if (operators.count(op))
        cout << "Valid operator" << endl;
    else
        cout << "Invalid operator" << endl;

    return 0;
}
