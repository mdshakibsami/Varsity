#include <bits/stdc++.h>
using namespace std;

int main()
{
    ifstream file("input-1.txt");

    char nt;
    int p;
    file >> nt >> p;

    vector<string> prods(p);
    for (int i = 0; i < p; i++)
        file >> prods[i];
    file.close();

    vector<string> alpha, beta;
    for (auto prod : prods)
    {
        if (prod[0] == nt)                   
            alpha.push_back(prod.substr(1)); 
        else                                 
            beta.push_back(prod);
    }

    // Print S -> beta S'
    cout << nt << " -> ";
    for (int i = 0; i < beta.size(); i++)
    {
        cout << beta[i] << nt << "'";
        if (i != beta.size() - 1)
            cout << " | ";
    }
    cout << endl;

    // Print S' -> alpha S' | epsilon
    cout << nt << "' -> ";
    for (int i = 0; i < alpha.size(); i++)
    {
        cout << alpha[i] << nt << "'";
        if (i != alpha.size() - 1)
            cout << " | ";
    }
    cout << " | e" << endl;

    return 0;
}
