const path = require('path');
const { merge } = require('webpack-merge');
const flarumConfig = require('@flarum/build/config/webpack.config.js');

module.exports = [
  merge(flarumConfig(), {
    name: 'forum',
    entry: {
      forum: './src/forum.js'
    },
    output: {
      path: path.resolve(__dirname, '../js/dist'),
      filename: 'forum.js'
    }
  }),
  merge(flarumConfig(), {
    name: 'admin',
    entry: {
      admin: './src/admin.js'
    },
    output: {
      path: path.resolve(__dirname, '../js/dist'),
      filename: 'admin.js'
    }
  })
];
