#include <iostream>
using namespace std;

void JobSequence(int profit[], int deadline[], int jobs[], int n)
{
    // sort them according to max profit
    for (int i = 0; i < n; i++)
    {
        for (int j = i + 1; j < n; j++)
        {
            if (profit[i] < profit[j])
            {
                swap(profit[i], profit[j]);
                swap(deadline[i], deadline[j]);
                swap(jobs[i], jobs[j]);
            }
        }
    }

    // for(int i=0;i<n;i++) cerr<<jobs[i]<<" ";

    // calculate the max deadline for result array
    int max = deadline[0];
    for (int i = 1; i < n; i++)
        if (deadline[i] > max)
            max = deadline[i];

    // result array with 0 initialize
    int result[max];
    for (int i = 0; i < max; i++)
        result[i] = -1;


    // main algo
    int totalProfit = 0;
    for (int i = 0; i < n; i++) // ** until max
    {
        if (result[deadline[i] - 1] == -1)
        {
            totalProfit += profit[i];
            result[deadline[i] - 1] = jobs[i];
        }
        else
        {
            for (int j = deadline[i] - 1; j >= 0; j--)
            {
               
                if (result[j] == -1)
                {
                    result[j] = jobs[i];
                    totalProfit+=profit[i];
                    break;
                }
            }
        }
    }

    // final result
    cout<<totalProfit<<endl;

    for (int i = 0; i < max; i++)  //*** until max */
    {
        cout << result[i] << " ";
    }

}

int main()
{
    int n;
    cin >> n;
    int profit[n], deadline[n], jobs[n];
    for (int i = 0; i < n; i++)
    {
        int x, y;
        cin >> x >> y;
        profit[i] = x;
        deadline[i] = y;
        jobs[i] = i;
    }

    JobSequence(profit, deadline, jobs, n);
}