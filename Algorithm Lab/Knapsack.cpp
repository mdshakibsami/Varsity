#include <bits/stdc++.h>
using namespace std;

void Knapsack(int profit[], int weight[], int n, int capacity)
{
    float ratio[n];
    int originalIndex[n];  // ***

    float result[n];      // **
    for(int i=0;i<n;i++) result[i]=0;

    for (int i = 0; i < n; i++)
    {
        ratio[i] = profit[i] * 1.0 / weight[i];
        originalIndex[i] = i;
    }

    for (int i = 0; i < n; i++)     //** */
    {
        for (int j = i + 1; j < n; j++)
        {
            if (ratio[i] < ratio[j])
            {
                swap(ratio[i], ratio[j]);
                swap(profit[i], profit[j]);
                swap(weight[i], weight[j]);
                swap(originalIndex[i], originalIndex[j]); // Swap original indices
            }
        }
    }

    // for (int i = 0; i < n; i++)
    //     cout << profit[i] << " ";
    // cout << endl;
    // for (int i = 0; i < n; i++)
    //     cout << weight[i] << " ";
    // cout << endl;
    // for (int i = 0; i < n; i++)
    //     cout << ratio[i] << " ";

    // int i;
    // for (int i = 0; i < n; i++)
    //     cin >> result[i];

    int i, totalProfit = 0;

    for (i = 0; i < n; i++)
    {
        if (weight[i] > capacity)
            break;
        else
        {
            totalProfit += profit[i];
            capacity -= weight[i];
            result[originalIndex[i]]=1;
        }
    }

    if (i < n)
    {
        
        totalProfit += (ratio[i] * capacity);
        result[originalIndex[i]]= ratio[i];
    }

    cout << totalProfit<<endl;

    for(int i=0;i<n;i++) cout<<result[i]<<" ";
}

int main()
{
    int n;
    cin >> n;
    int m;
    cin >> m;
    int profit[n], weight[n];

    for (int i = 0; i < n; i++)
    {
        int x, y;
        cin >> x >> y;
        profit[i] = x;
        weight[i] = y;
    }

    Knapsack(profit, weight, n, m);
}