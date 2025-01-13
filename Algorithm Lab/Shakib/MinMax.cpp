#include <iostream>
using namespace std;

void MinMax(int arr[], int l, int h, int &min, int &max)
{
    if (l == h)
        max = min = arr[l];
    else if (l == h - 1)
    {
        if (arr[l] > arr[h])
        {
            max = arr[l];
            min = arr[h];
        }
        else
        {
            min = arr[l];
            max = arr[h];
        }
    }
    else
    {
        int mid = (l + h) / 2;
        int max1,min1; 
        MinMax(arr,l,mid,min,max);
        MinMax(arr,mid+1,h,min1,max1);


        if(min>min1) min = min1;
        if(max<max1) max = max1;
    }
}

int main()
{
    int n;
    cin >> n;
    int arr[n];
    for (int i = 0; i < n; i++)
        cin >> arr[i];
    int min, max; 

    MinMax(arr, 0, n - 1, min, max);

    cout<<min<<" "<<max<<endl;
}