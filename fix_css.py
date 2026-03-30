import os

flask_css = '/Users/luiseduardosantanodelgado/Desktop/pruebassss/macuin/Cliente_Flask/app/static/css/styles.css'
laravel_css = '/Users/luiseduardosantanodelgado/Desktop/pruebassss/macuin/Cliente_Laravel/public/resources/css/styles.css'

def update_css(filepath, is_flask):
    with open(filepath, 'r') as f:
        content = f.read()

    prefix = 'ul.productos' if is_flask else '.product-list'

    # Unify grid column size and gap
    content = content.replace('grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));', 'grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));')
    content = content.replace('grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));', 'grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));')
    content = content.replace('gap: 20px;', 'gap: 25px;')
    
    # Unify figure height
    content = content.replace('height: 155px;', 'height: 180px;')
    
    # Unify figure background
    content = content.replace('background: #e4e4e4;', 'background: #ffffff;')

    # Unify article background
    if not is_flask:
        content = content.replace('background-color: #F5C518;', 'background-color: #1a1a1a;')

    if is_flask:
        # In flask article background is already #1a1a1a
        pass
        
    with open(filepath, 'w') as f:
        f.write(content)

update_css(flask_css, True)
update_css(laravel_css, False)
print("CSS updated!")
