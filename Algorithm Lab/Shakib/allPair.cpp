#include <bits/stdc++.h>
using namespace std;

void allPair(int graph[][100], int n)
{
    for (int k = 0; k < n; k++)
    {
        for (int i = 0; i < n; i++)
        {
            for (int j = 0; j < n; j++)
            {
                if (graph[i][k] != INT_MAX && graph[k][j] != INT_MAX && graph[i][k] + graph[k][j] < graph[i][j])
                {
                    graph[i][j] = graph[i][k] + graph[k][j];
                }
            }
        }
    }
}

int main()
{
    int n, e;
    cin >> n >> e;

    int graph[100][100];

    for (int i = 0; i < n; i++)
    {
        for (int j = 0; j < n; j++)
        {
            if (i == j)
                graph[i][j] = 0;
            else
                graph[i][j] = INT_MAX;
        }
    }

    for (int i = 0; i < e; i++)
    {

        int x, y, z;
        cin >> x >> y >> z;
        x--;    y--;
        graph[x][y] = z;
    }

    allPair(graph, n);

    for(int i=0;i<n;i++)
    {
        for(int j=0;j<n;j++)
        {
            if(graph[i][j]== INT_MAX) cout<<"INF ";
            else cout<<graph[i][j]<<" ";
        }
        cout<<endl;
    }

}