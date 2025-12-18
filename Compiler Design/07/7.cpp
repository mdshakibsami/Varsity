/*
 * 07 Write a C++ program to count the number of operators from a given string.
 */

#include <iostream>
#include <string>
#include <vector>
using namespace std;

// Function to check if substring is a valid operator
bool isOperator(const string &s)
{
    vector<string> operators = {
        "+", "-", "*", "/", "%", "=",
        "==", "!=", "<", ">", "<=", ">=",
        "&&", "||", "!",
        "+=", "-=", "*=", "/=", "%="};
    for (auto op : operators)
    {
        if (s == op)
            return true;
    }
    return false;
}

int main()
{
    string str;
    cout << "Enter a string: ";
    getline(cin, str);

    int count = 0;

    for (int i = 0; i < str.size(); i++)
    {
        // Check 2-character operators first
        if (i + 1 < str.size())
        {
            string twoChar = str.substr(i, 2);
            if (isOperator(twoChar))
            {
                count++;
                i++; // Skip next char
                continue;
            }
        }

        // Check 1-character operators
        string oneChar = str.substr(i, 1);
        if (isOperator(oneChar))
        {
            count++;
        }
    }

    cout << "Number of operators: " << count << endl;

    return 0;
}
