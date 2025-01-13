#include <bits/stdc++.h>
using namespace std;

void Dijkstra(vector<vector<pair<int, int>>> &graph, int source, int n)
{
    vector<int> visited(n, 0);
    vector<int> dist(n, INT_MAX);

    set<pair<int, int>> st;
    st.insert({0, source});
    dist[source] = 0;

    while (st.size() > 0)
    {
        auto mPair = *st.begin();
        int v = mPair.second;
        st.erase(st.begin());

        if (visited[v])
            continue;
        visited[v] = 1;
        for (auto child : graph[v])
        {
            int child_v = child.first;
            int wt = child.second;

            if (dist[v] + wt < dist[child_v])
            {
                dist[child_v] = dist[v] + wt;
                st.insert({dist[child_v], child_v});
            }
        }
    }

    // Output the shortest distances
    for (int i = 0; i < n; i++)
    {
        if (dist[i] == INT_MAX)
            cout << "INF ";
        else
            cout << dist[i] << " ";
    }
    cout << endl;
}

int main()
{
    int n, e;
    cin >> n >> e;
    vector<vector<pair<int, int>>> graph(n + 1);
    for (int i = 0; i < e; i++)
    {
        int x, y, z;
        cin >> x >> y >> z;
        graph[x].push_back({y, z});
    }

    int source;
    cin >> source;

    Dijkstra(graph, source, n + 1);
}