from flask import Flask, request, jsonify
from geopy.geocoders import Nominatim
import osmnx as ox
import networkx as nx

app = Flask(__name__)
geolocator = Nominatim(user_agent="route_calculator")

@app.route('/calculate_route', methods=['POST'])
def calculate_route():
    # Your existing code here

    origin = request.json.get('origin')
    destination = request.json.get('destination')

    # Geocode origin and destination
    origin_loc = geolocator.geocode(origin)
    dest_loc = geolocator.geocode(destination)
    
    if not origin_loc or not dest_loc:
        return jsonify({'error': 'Invalid locations'}), 400

    origin_coords = (origin_loc.latitude, origin_loc.longitude)
    dest_coords = (dest_loc.latitude, dest_loc.longitude)
    
    # Download the map graph
    G = ox.graph_from_point(origin_coords, dist=10000, network_type='drive')

    # Get nearest nodes
    origin_node = ox.distance.nearest_nodes(G, origin_coords[1], origin_coords[0])
    dest_node = ox.distance.nearest_nodes(G, dest_coords[1], dest_coords[0])

    # Calculate the shortest path
    route = nx.shortest_path(G, origin_node, dest_node, weight='length')
    route_coords = [(G.nodes[node]['y'], G.nodes[node]['x']) for node in route]

    return jsonify({
        'route': route_coords,
        'origin': origin_coords,
        'destination': dest_coords
    })
@app.errorhandler(Exception)
def handle_exception(e):
     response = {
         "error": str(e)
      }
     return jsonify(response), 500


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
