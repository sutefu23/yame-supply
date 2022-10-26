module.exports = {
  root: true,
  env: {
    node: true
  },
  extends: [
    "eslint:recommended",
    "plugin:vue/vue3-essential",
    "@vue/typescript/recommended",
    "prettier"
  ],
  parserOptions: {
    ecmaVersion: 2020
  },
  globals: {
    route: true,
    Ziggy: true,
    ValidationError: true
  },
  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "warn" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "warn" : "off",
    complexity: ["error", 10],
    "max-depth": ["error", 4],
    eqeqeq: "error",
    yoda: "error",
    "consistent-this": ["error", "self"],
    "arrow-body-style": "error",
    "no-var": "error",
    "no-lonely-if": "error",
    "no-multiple-empty-lines": "error",
    "no-nested-ternary": "error",
    "prefer-const": "error",
    "prefer-spread": "error",
    "prefer-template": "error",
    "no-cond-assign": "error",
    "no-extra-semi": "error",
    "no-func-assign": "error",
    "no-implicit-coercion": "error",
    "no-invalid-this": "error",
    "no-unexpected-multiline": "error",
    "func-style": "error",
    "vue/multi-word-component-names": "off"
  },
  overrides: [
    {
      files: ["**/*.(ts|vue)"],
      parser: "@typescript-eslint/parser",
      parserOptions: {
        project: "./tsconfig.json",
        tsconfigRootDir: "."
      },
      plugins: ["@typescript-eslint"],
      rules: {
        "no-use-before-define": "off",
        "@typescript-eslint/no-use-before-define": ["error"],
        "@typescript-eslint/no-var-requires": "error",
        "@typescript-eslint/explicit-function-return-type": [
          "error",
          {
            allowExpressions: true,
            allowTypedFunctionExpressions: true
          }
        ],

        camelcase: "off",
        "@typescript-eslint/naming-convention": [
          "error",
          {
            selector: "default",
            format: ["camelCase"]
          },
          {
            selector: ["enum", "enumMember"],
            format: ["UPPER_CASE"]
          },
          {
            selector: ["variableLike", "memberLike"],
            format: ["strictCamelCase"]
          },
          {
            selector: ["variable", "parameter"],
            format: ["strictCamelCase", "StrictPascalCase"],
            leadingUnderscore: "allow"
          },
          {
            selector: ["function", "method"],
            format: ["camelCase"],
            leadingUnderscore: "allow"
          },
          {
            selector: "typeLike",
            format: ["PascalCase"]
          }
        ]
      }
    }
  ]
};
