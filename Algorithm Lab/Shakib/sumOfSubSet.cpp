#include <bits/stdc++.h>
using namespace std;

int selected[100];
int weight[100];
//   current_sum,current_index,remaining_sum,target_sum,n
void SumOfSubSet(int cSum, int cInd, int rSum, int tSum, int n)  
{
    selected[cInd] = 1;
    if (cSum + weight[cInd] == tSum)
    {
        for (int i = 0; i < n; i++)
        {
            cout<<selected[i]<<" ";
            // if(selected[i]) cout<<weight[i]<<" ";  for actual values
        }
        cout << endl;
    }
    else if (cSum+weight[cInd]+weight[cInd+1]<=tSum)
    {

        SumOfSubSet(cSum + weight[cInd], cInd + 1, rSum - weight[cInd], tSum, n);
    }

    selected[cInd] = 0; // backtracking
    if ((cSum + rSum - weight[cInd] >= tSum) && (cSum + weight[cInd + 1] <= tSum))
    {
        SumOfSubSet(cSum, cInd + 1, rSum - weight[cInd], tSum, n);
    }
}

int main()
{
    int n;
    cin >> n;
    int rSum = 0;
    for (int i = 0; i < n; i++)
    {
        int x;
        cin >> x;
        rSum += x;
        weight[i] = x;
    }
    int tSum;
    cin >> tSum;

    SumOfSubSet(0, 0, rSum, tSum, n);
}