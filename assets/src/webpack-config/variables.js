const path = require('path');

const assetsDir = process.cwd();
const srcDir = assetsDir + '/src';
const distDir = assetsDir + '/dist';
const publicDir = path.resolve(assetsDir, '../public');

module.exports = {
    assetsDir,
    srcDir,
    distDir,
    publicDir,
};