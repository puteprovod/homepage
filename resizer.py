from flask import Flask
from flask import request
from flask import jsonify
from fileinput import filename
from PIL import Image
import os
import json
import sys

app = Flask(__name__)

@app.route('/')
def man ():
    script_path = os.getcwd()
    return script_path

@app.route('/test',  methods=['GET'])
def getpath():
    filepath = request.args.get('filepath')
    return filepath

@app.route('/resize',  methods=['GET'])
def resize():
    filepath = request.args.get('filepath')
    with open(filepath) as js:
        sl = json.load(js)
    for i in sl['images']:
        with Image.open(i['path']) as img:
            img.load()
        reimg = img.resize((i['targetWidth'], i['targetHeight']),1)
        reimg.save(i['filename'],quality=90)
        thumbimg = reimg.resize((i['thumbWidth'], i['thumbHeight']),1)
        thumbimg.save(i['thumbfilename'],quality=90)
    return "done", 200

@app.route('/res',  methods=['POST'])
def upload():
    if request.method == 'POST':
        f = request.files['file']
        f.save(f.filename)
        return 'http://127.0.0.1:5000/'+f.filename

if __name__ == '__main__':
    app.run()
