#include <bits/stdc++.h>
using namespace std;
const int INF = 1e9;

void Dijkstra(vector<vector<pair<int, int>>> &graph, int source, int n)
{
    vector<int> visited(n, 0);
    vector<int> dist(n, INF);
    // weight, vertex
    set<pair<int, int>> st;
    st.insert({0, source});
    dist[source] = 0;

    while (!st.empty())
    {
        // weight, vertex
        auto min_pair = *st.begin();
        int v = min_pair.second;
        st.erase(st.begin());

        if (visited[v])
            continue;
        visited[v] = 1;

        for (auto child : graph[v]) // (vertex,weight)
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
    for (int i = 0; i < n; i++) {
        if (dist[i] == INF)
            cout << "INF ";
        else
            cout << dist[i] << " ";
    }
    cout << endl;
}

int main()
{
    int n, m;
    cin >> n >> m;
    
    // Create graph with n+1 vertices to handle 1-based indexing
    vector<vector<pair<int, int>>> graph(n + 1); 
    
    // Reading edges and populating the graph
    for (int i = 0; i < m; i++)
    {
        int x, y, z;
        cin >> x >> y >> z;
        graph[x].push_back({y, z});
    }

    int source;
    cin >> source;
    
    Dijkstra(graph, source, n + 1);  // Pass n + 1 for 1-based indexing
    return 0;
}
