from flask import Flask

app = Flask(__name__)


def home():
    return "Hola Flask"

if __name__ == "__main__":
    app.run()