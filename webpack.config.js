const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('apps/frontend/restaurant'),
        },
    },
    https: true
};
