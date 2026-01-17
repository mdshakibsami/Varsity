/*
 * 05 Write a C++ program to recognize strings under 'a', 'a*b+', 'abb'.
 */


#include <bits/stdc++.h>
using namespace std;

int main()
{
    ifstream file;
    string word;
    file.open("input.txt");
    file >> word;
    if (word == "a")
        cout << "String belongs to language: a" << endl;
    else if (word == "abb")
        cout << "String belongs to language: abb or a*b+" << endl;
    else
    {
        int index = 0;
        bool isValid = true;
        for (int i = 0; i < word.size(); i++)
        {
            if (word[i] == 'b')
            {
                index = i;
                break;
            }
        }
        for (int i = index; i < word.size(); i++)
        {

            if (word[i] == 'a')
            {
                isValid = false;
                break;
            }
        }

        if (isValid && word.size())
            cout << "String belongs to language: a*b+" << endl;
        else
            cout << "Did not matched any language." << endl;
    }
}
