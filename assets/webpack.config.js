const path = require('path');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const sveltePreprocess = require('svelte-preprocess');
const entries = require('./src/webpack-config/entries.js');

console.log(entries);
const assetsDir = __dirname;
const srcDir = assetsDir + '/src';
const distDir = assetsDir + '/dist';
const publicDir = path.resolve('../public');




module.exports = function(env, argv) {
    const isProd = argv.mode === 'production';
    const isDev = argv.mode === 'development';

    return {
        mode: argv.mode,
        context: assetsDir,
        entry: entries,    
        output: {
            path: distDir,
            filename: '[name].js',
            clean: true,
            publicPath: '',
        },
        externals: {
            jquery: 'jQuery',
        },
        resolve: {
            alias: {
                srcDir: srcDir,
            },
        },
        plugins: [
            new WebpackManifestPlugin({
                fileName: assetsDir + '/manifest.json',
            }),
            new MiniCssExtractPlugin({
                filename: '[name].css'
            })
        ],
        module: {
            rules: [
                {
                    test: /\.(png|jpe?g|gif|svg|eot|ttf|woff|woff2)$/i,
                    type: "asset",
                },
                {
                    test: /\.html$/i,
                    loader: "html-loader",
                },
                {
                    test: /\.js$/i,
                        exclude: /node_modules/,
                        use: {
                            loader: "babel-loader"
                        }
                },
              {
                test: /\.(css|scss)$/i,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {}
                    },
                    { 
                        loader: "css-loader",
                        options: { 
                            importLoaders: 2,
                            sourceMap: true,
                            modules: {
                                auto: true,
                                namedExport: true,
                            }
                        } 
                    },
                    "postcss-loader",
                    "sass-loader",
                ]
              },
              {
                test: /\.svelte$/i,
                use: {
                    loader: 'svelte-loader',
                    options: {
                        emitCss: true,
                        preprocess: sveltePreprocess(),
                        compilerOptions: {
                            customElement: true
                        }
                    }
                }
              }
            ]
        },
        devServer: {
            host: '0.0.0.0',
            port: 8080,
            static: {
                directory: publicDir,
                serveIndex: true,
            }
        },
        devtool: 'source-map'
    }
};
