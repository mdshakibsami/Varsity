#include<bits/stdc++.h>
using namespace std;

const int N = 1e7;
int arr[N],B[N];


void Merge(int l, int mid, int h)
{
    int i= l;
    int j= mid+1;
    int k=l;

    while (i<=mid && j<=h)  // ***  condition
    {
        if(arr[i]<arr[j])
        {
            B[k]=arr[i];
            i++;    k++;
        }
        else 
        {
            B[k] = arr[j];
            j++;    k++;
        }
    }
    
    if(i>mid)
    {
        while(j<=h)  
        {
            B[k] = arr[j];
            j++;    k++;
        }
    }

    if(j>h)
    {
        while(i<=mid)
        {
            B[k]=arr[i];
            i++;    k++;
        }
    }
    
    for(int i=l;i<=h;i++)  // **** low to high
    {
        arr[i] = B[i];
    }
}

void MergeSort(int l, int h)
{
    if(l<h)
    {
        int mid = (l+h)/2;
        MergeSort(l,mid);
        MergeSort(mid+1,h);
        
        Merge(l,mid,h);
    }
}


int main()
{
    int n;  cin>>n;
    for(int i=0;i<n;i++)
    {
        cin>>arr[i];
    }

    MergeSort(0,n-1);

    for(int i=0;i<n;i++) cout<<arr[i]<<" ";
}