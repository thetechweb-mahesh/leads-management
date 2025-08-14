import './bootstrap';
import '../css/app.css';
import React from 'react';
import { createRoot } from 'react-dom/client';
import LeadForm from './components/LeadForm';

document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("leadform");
    if (el) {
        createRoot(el).render(<LeadForm />);
    }
});
