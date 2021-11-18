const { readdirSync } = require('fs');
const path = require('path');
const {srcDir, distDir} = require('./variables.js');


class EntryBuilder
{
    constructor(){
        this.entries = {};
    }

    addEntry(dist, src, ext){
        readdirSync (src).filter(file => file.endsWith(ext))
        .forEach(file => {
            let basename = path.basename(file, ext);
            this.entries[this.trimStart(`${dist}/${basename}`, `${distDir}/`)] 
                = './src/' + this.trimStart(`${src}/${file}`, `${srcDir}/`);
        });
        return this;
    }

    trimStart(path, subString){
        return path.replace(new RegExp(`^${subString}`), '');
    }

    trimEnd(path, subString){
        return path.replace(new RegExp(`${subString}$`), '');
    }

    build(){
        return this.entries;
    }
}


let entries = new EntryBuilder()
    // .addEntry(`${distDir}/examples`, `${srcDir}/examples`, '.scss') 
    .addEntry(`${distDir}/examples`, `${srcDir}/examples`, '.js') 
    // .addEntry(`${distDir}/examples`, `${srcDir}/examples`, '.css') 
    .build();


module.exports = entries;
