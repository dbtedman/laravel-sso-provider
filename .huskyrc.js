//------------------------------------------------------------------------------
//
// Husky Configuration, https://github.com/typicode/husky
//
//------------------------------------------------------------------------------

module.exports = {
  hooks: {
    "pre-commit": "npm run lint && composer run-script lint"
  }
};
