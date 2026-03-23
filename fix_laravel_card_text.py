import re

css_path = '/Users/luiseduardosantanodelgado/Desktop/pruebassss/macuin/Cliente_Laravel/public/resources/css/styles.css'
with open(css_path, 'r') as f:
    css = f.read()

# article h3
css = re.sub(r'(\.product-list li article h3 \{[^}]*color:\s*)#111111(;)', r'\1#ffffff\2', css)
# article footer strong
css = re.sub(r'(\.product-list li article footer strong \{[^}]*color:\s*)#111111(;)', r'\1#F5C518\2', css)
# article footer .action-link
css = re.sub(r'(\.product-list li article footer \.action-link \{[^}]*color:\s*)#111(;)', r'\1#F5C518\2', css)

with open(css_path, 'w') as f:
    f.write(css)

print("Laravel Card text colors fixed!")
