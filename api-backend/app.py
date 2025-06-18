from flask import Flask, jsonify, request, redirect
from flask_cors import CORS
import mysql.connector
from mysql.connector import Error
import os
# ✅ Load environment variables
from dotenv import load_dotenv
load_dotenv()
app = Flask(__name__)
CORS(app)

# Database Configuration from Environment Variables (with fallback)
db_config = {
    'host': os.environ.get('DB_HOST', '127.0.0.1'),
    'database': os.environ.get('DB_NAME', 'myproject_db'),
    'user': os.environ.get('DB_USER', 'root'),
    'password': os.environ.get('DB_PASSWORD', '')
}

def get_db_connection():
    try:
        return mysql.connector.connect(**db_config)
    except Error as e:
        print(f"Database Connection Error: {e}")
        return None

@app.route('/')
def index():
    return "API is running!"

# ------------------- Branches -------------------

@app.route('/api/branches', methods=['GET'])
def get_branches():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT id, name, email, phone, logo FROM branches ORDER BY id")
    rows = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify(rows)

@app.route('/api/branches', methods=['POST'])
def create_branch():
    data = request.get_json()
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("INSERT INTO branches (name, email, phone, logo) VALUES (%s, %s, %s, %s)",
                       (data['name'], data['email'], data['phone'], data['logo']))
        conn.commit()
        return jsonify({'message': 'Branch created', 'id': cursor.lastrowid}), 201
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/branches/<int:id>', methods=['PUT'])
def update_branch(id):
    data = request.get_json()
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("UPDATE branches SET name=%s, email=%s, phone=%s, logo=%s WHERE id=%s",
                       (data['name'], data['email'], data['phone'], data['logo'], id))
        conn.commit()
        return jsonify({'message': 'Branch updated'})
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/branches/<int:id>', methods=['DELETE'])
def delete_branch(id):
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("DELETE FROM branches WHERE id=%s", (id,))
        conn.commit()
        return jsonify({'message': 'Branch deleted'})
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

# ------------------- Categories -------------------

@app.route('/api/categories', methods=['GET'])
def get_categories():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT id, name, created_at FROM categories ORDER BY id")
    rows = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify(rows)

@app.route('/api/categories/<int:id>', methods=['GET'])
def get_category(id):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        cursor.execute("SELECT id, name, created_at FROM categories WHERE id = %s", (id,))
        row = cursor.fetchone()
        if row:
            return jsonify(row)
        else:
            return jsonify({'error': 'Category not found'}), 404
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/categories', methods=['POST'])
def create_category():
    data = request.get_json()
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        cursor.execute("INSERT INTO categories (name) VALUES (%s)", (data['name'],))
        conn.commit()
        new_id = cursor.lastrowid
        cursor.execute("SELECT id, name, created_at FROM categories WHERE id = %s", (new_id,))
        return jsonify(cursor.fetchone()), 201
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/categories/<int:id>', methods=['PUT'])
def update_category(id):
    data = request.get_json()
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("UPDATE categories SET name = %s WHERE id = %s", (data['name'], id))
        conn.commit()
        return jsonify({'message': 'Category updated'})
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/categories/<int:id>', methods=['DELETE'])
def delete_category(id):
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("DELETE FROM categories WHERE id = %s", (id,))
        conn.commit()
        return jsonify({'message': 'Category deleted'})
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

# ------------------- Products -------------------

@app.route('/api/products', methods=['GET'])
def get_products():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    query = """
        SELECT p.id, p.name, p.cost, p.price, c.name AS category_name, b.name AS branch_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        JOIN branches b ON p.branch_id = b.id
    """
    cursor.execute(query)
    rows = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify(rows)

@app.route('/api/products', methods=['POST'])
def create_product():
    data = request.get_json()
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("INSERT INTO products (name, cost, price, category_id, branch_id) VALUES (%s, %s, %s, %s, %s)",
                       (data['name'], data['cost'], data['price'], data['category_id'], data['branch_id']))
        conn.commit()
        return jsonify({'message': 'Product created'}), 201
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/products/<int:id>', methods=['PUT'])
def update_product(id):
    data = request.get_json()
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("UPDATE products SET name=%s, cost=%s, price=%s, category_id=%s, branch_id=%s WHERE id=%s",
                       (data['name'], data['cost'], data['price'], data['category_id'], data['branch_id'], id))
        conn.commit()
        return jsonify({'message': 'Product updated'})
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

@app.route('/api/products/<int:id>', methods=['DELETE'])
def delete_product(id):
    conn = get_db_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("DELETE FROM products WHERE id=%s", (id,))
        conn.commit()
        return jsonify({'message': 'Product deleted'})
    except Error as e:
        return jsonify({'error': str(e)}), 500
    finally:
        cursor.close()
        conn.close()

# ------------------- Run the App -------------------

if __name__ == '__main__':
    port = int(os.environ.get('PORT', 5000))
    debug_mode = os.environ.get('FLASK_DEBUG', 'False').lower() in ['true', '1', 't']
    app.run(host='0.0.0.0', port=port, debug=debug_mode)
