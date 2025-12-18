/*
* 05 Write a C++ program to recognize strings under 'a', 'a*b+', 'abb'.
*/

#include <bits/stdc++.h>
using namespace std;

int main()
{
    string s;
    cout << "Enter a string: ";
    cin >> s;

    // Check for "a"
    if (s == "a")
    {
        cout << "String belongs to language: a" << endl;
    }

    // Check for "abb"
    else if (s == "abb")
    {
        cout << "String belongs to language: abb" << endl;
    }

    // Check for "a*b+"
    else
    {
        int i = 0;

        // Match zero or more 'a'
        while (i < s.length() && s[i] == 'a')
        {
            i++;
        }

        // Must have at least one 'b'
        if (i < s.length() && s[i] == 'b')
        {
            while (i < s.length() && s[i] == 'b')
            {
                i++;
            }

            // If end reached, it's valid
            if (i == s.length())
            {
                cout << "String belongs to language: a*b+" << endl;
            }
            else
            {
                cout << "String does not belong to given languages" << endl;
            }
        }
        else
        {
            cout << "String does not belong to given languages" << endl;
        }
    }

    return 0;
}
