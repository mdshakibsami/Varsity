#include <bits/stdc++.h>
using namespace std;
int main()
{
    freopen("input.txt", "r", stdin);
    int n;
    cin >> n;
    int t = n;
    vector<int> burstTime,priority, waitingTime, turnAroundTime;
    vector<string> process;
    for (int i = 0; i < n; i++)
    {
        int bt, pr;
        string name;
        cin >> bt >> pr >> name;
        burstTime.push_back(bt);
        priority.push_back(pr);
        process.push_back(name);
    }
    for (int i = 0; i < n; i++)
    {
        for (int j = i + 1; j < n; j++)
        {
            if (priority[i] > priority[j])
            {
                swap(priority[i], priority[j]);
                swap(burstTime[i], burstTime[j]);
                swap(process[i], process[j]);
            }
        }
    }

    for(auto x:burstTime) cout<<x<<" ";
    cout<<endl;

    int TA = 0;
    for (int i = 0; i < burstTime.size(); i++)
    {
        waitingTime.push_back(TA);
        TA += burstTime[i];
        turnAroundTime.push_back(TA);
    }

    // cout << "Total turn around time : " << TA << endl;
    // float avgWaitingTime = accumulate(waitingTime.begin(), waitingTime.end(), 0);
    // cout << avgWaitingTime;
    // cout << "Average Waiting Time : " << avgWaitingTime / brustTime.size() << endl;
    for (auto p : process)
        cout << p << " => ";
    cout << "end.";
}