#include <bits/stdc++.h>
using namespace std;

const int N = 1e7;
int arr[N];

int Partition(int l, int h)
{
    int pivot = arr[l];
    int i = l, j = h;

    while (i < j) // ****
    {
        do
        {
            i++;
        } while (arr[i] <= pivot);

        do
        {
            j--;
        } while (arr[j] > pivot);

        if (i < j)
            swap(arr[i], arr[j]);
    }
    swap(arr[l],arr[j]);
    return j;
}

void QuickSort(int l, int h)
{
    if (l < h)  //****** */
    {
        int j = Partition(l, h);
        QuickSort(l, j);      // *****
        QuickSort(j + 1, h);
    }
}

int main()
{
    int n;
    cin >> n;
    for (int i = 0; i < n; i++)
    {
        cin >> arr[i];
    }

    QuickSort(0, n - 1);

    for (int i = 0; i < n; i++)
        cout << arr[i] << " ";
}