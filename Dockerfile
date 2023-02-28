# Use the official Node.js 14 image as the base image
FROM node:14

# Set the working directory in the container
WORKDIR /app

# Copy the package.json and package-lock.json files to the container
COPY package*.json ./

# Install the dependencies in the container
RUN npm install

# Copy the rest of the application files to the container
COPY . .

# Set the environment variable for the PORT
ENV PORT=3000

# Expose the port used by the application
EXPOSE 3000

# Start the application
CMD ["npm", "start"]
