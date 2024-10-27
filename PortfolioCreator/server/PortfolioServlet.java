package com.portfolio;

import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class PortfolioServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        // Extract portfolio form data
        String name = request.getParameter("name");
        String bio = request.getParameter("bio");
        String skills = request.getParameter("skills");
        String projects = request.getParameter("projects");

        // Output portfolio info
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html><body>");
        out.println("<h1>Portfolio Created</h1>");
        out.println("<p>Name: " + name + "</p>");
        out.println("<p>Bio: " + bio + "</p>");
        out.println("<p>Skills: " + skills + "</p>");
        out.println("<p>Projects: " + projects + "</p>");
        out.println("</body></html>");
    }
}
