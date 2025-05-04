#include <bits/stdc++.h>
using namespace std;

signed main()
{
    freopen("input.txt", "r", stdin);

    int n;
    cin >> n;
    vector<int> burstTime, waitingTime, TurnAroundVec;
    int turnAroundTime = 0;
    vector<string> process;
    for (int i = 0; i < n; i++)
    {
        int x;
        cin >> x;
        burstTime.push_back(x);
        string s;
        cin >> s;
        process.push_back(s);
    }

    // FCFS: No sorting — execute in the order given

    for (int i = 0; i < n; i++)
    {
        waitingTime.push_back(turnAroundTime); // WT = TA - AT; AT = 0
        turnAroundTime += burstTime[i];
        TurnAroundVec.push_back(turnAroundTime);
    }

    float avgWaitingTime = accumulate(waitingTime.begin(), waitingTime.end(), 0);
    avgWaitingTime /= n;
    cout << endl;

    for (int i = 0; i < n; i++)
        cout << process[i] << " => ";
    cout << "end" << endl
         << endl;

    cout << "Process " << "   Burst Time " << "   Waiting Time" << "  " << "Turn Around Time" << endl;
    for (int i = 0; i < n; i++)
        cout << process[i] << "            " << burstTime[i] << "          " << waitingTime[i] << "                " << TurnAroundVec[i] << endl;

    cout << endl
         << "Total Turn Around Time: " << turnAroundTime << endl;
    cout << endl
         << "Average waiting Time: " << avgWaitingTime << endl;
}
