const db = require("../config/database");
var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', async function(req, res, next) {
  res.render("index");
});

/* GET wished page */
router.get('/wished', async function(rep, res, next) {
  const { rows: wished } = await db.query(
    "SELECT * FROM places WHERE visited=false"
  );
  res.render("wished", {wished});
});

/* GET visited page */
router.get('/visited', async function(rep, res, next) {
  const { rows: visited } = await db.query(
    "SELECT * FROM places WHERE visited=true"
  );
  res.render("visited", {visited});
});

module.exports = router;

