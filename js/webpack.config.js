const path = require('path');
const flarumConfig = require('flarum-webpack-config');

const forumConfig = flarumConfig({
  mode: process.env.NODE_ENV,
  entry: {
    forum: './src/forum/index.js'
  },
  output: {
    path: path.resolve(__dirname, '../js/dist'),
    filename: 'forum.js'
  },
  resolve: {
    alias: {
      'flarum-common': path.resolve(__dirname, '../../../../vendor/flarum/core/js/dist/common'),
      'flarum-forum': path.resolve(__dirname, '../../../../vendor/flarum/core/js/dist/forum')
    }
  }
});

const adminConfig = flarumConfig({
  mode: process.env.NODE_ENV,
  entry: {
    admin: './src/admin/index.js'
  },
  output: {
    path: path.resolve(__dirname, '../js/dist'),
    filename: 'admin.js'
  },
  resolve: {
    alias: {
      'flarum-common': path.resolve(__dirname, '../../../../vendor/flarum/core/js/dist/common'),
      'flarum-admin': path.resolve(__dirname, '../../../../vendor/flarum/core/js/dist/admin')
    }
  }
});

module.exports = [forumConfig, adminConfig];