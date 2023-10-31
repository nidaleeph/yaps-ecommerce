import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import express from 'express';

// Create an Express app
const app = express();

app.use((req, res, next) => {
  res.setHeader('Access-Control-Allow-Origin', '*'); // Replace with your Vue app's domain
  res.setHeader('Access-Control-Allow-Methods', 'GET,POST'); // Adjust as needed
  res.setHeader('Access-Control-Allow-Headers', '*');
  next();
});

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  server: {
    // Use the Express app as middleware
    middleware: app,
  },
})

