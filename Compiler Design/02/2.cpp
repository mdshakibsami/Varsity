/*
Write a C program to scan and count the number of characters, words, and lines in a file.
*/

#include <bits/stdc++.h>
using namespace std;

int main()
{
    ifstream file;
    char ch;
    int characters = 0, words = 0, lines = 0;
    bool inWord = false;

    file.open("2.txt");

    if (!file)
    {
        cout << "File not found!" << endl;
        return 0;
    }

    while (file.get(ch))
    {
        if (ch != ' ' && ch != '\n' && ch != '\t')
            characters++;

        if (ch == '\n')
            lines++;

        if (ch == ' ' || ch == '\n' || ch == '\t')
        {
            inWord = false;
        }
        else if (!inWord)
        {
            inWord = true;
            words++;
        }
    }

    if (characters > 0)
        lines++;

    file.close();

    cout << "Characters: " << characters << endl;
    cout << "Words: " << words << endl;
    cout << "Lines: " << lines << endl;

    return 0;
}
