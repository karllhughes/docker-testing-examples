const express = require('express');
const cors = require('cors');
const app = express();

app.use(cors());

/**
 * Single endpoint API for demonstration purposes.
 */
app.get('/', (req, res) => {
  // A hard coded data response
  const data = {
    quote: "'Programming' is a four-letter word.",
    source: "Craig Bruce",
  };
  res.setHeader('Content-Type', 'application/json');
  res.send(JSON.stringify(data));
});

app.listen(3000, () => console.log('Listening on port 3000'));
