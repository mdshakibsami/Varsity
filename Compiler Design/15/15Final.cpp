#include <bits/stdc++.h>
using namespace std;

// Compute LCP of vector of strings
string computeLCP(vector<string> v)
{
    if (v.empty())
        return "";
    string first = v.front();
    string last = v.back();
    auto it = mismatch(first.begin(), first.end(), last.begin());
    return string(first.begin(), it.first);
}

int main()
{
    ifstream file("15-1.txt");
    char nt;
    int p;
    file >> nt >> p;

    vector<string> v(p);
    for (int i = 0; i < p; i++)
        file >> v[i];

    file.close();

    set<string> newVec;

    sort(v.begin(), v.end());

    vector<string> groupWithPrefix;
    vector<string> others;

    groupWithPrefix.push_back(v[0]);

    for (int i = 1; i < v.size(); i++)
    {
        if (v[i][0] == v[0][0])
            groupWithPrefix.push_back(v[i]);
        else
            others.push_back(v[i]);
    }

    string lcp = computeLCP(groupWithPrefix);
    int len = lcp.size();
    cout << "Common Prefix: " << lcp << endl;

    // Step 4: Build suffixes for new non-terminal
    for (auto s : groupWithPrefix)
    {
        if (s.size() == len)
            newVec.insert("e");
        else if (s.size() > len)
        {
            string temp = "";
            for (int i = len; i < s.size(); i++)
                temp += s[i];
            newVec.insert(temp);
        }
    }

    cout << nt << " -> " << lcp << nt << "'" << " | ";
    for (auto x : others)
        cout << x << " | ";
    cout << endl;

    cout << nt << "' -> ";
    for (auto x : newVec)
        cout << x << " | ";
    cout << endl;

    return 0;
}
