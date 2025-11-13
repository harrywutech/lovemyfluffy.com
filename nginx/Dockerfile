FROM nginx:1.24-alpine

# Install additional tools
RUN apk add --no-cache \
    curl \
    wget \
    openssl

# Remove default configuration
RUN rm /etc/nginx/conf.d/default.conf

# Copy custom configuration
COPY conf.d/ /etc/nginx/conf.d/

# The nginx user and group already exist in the base nginx:alpine image
# Just ensure proper ownership of directories we'll modify

# Set proper permissions
RUN chown -R nginx:nginx /var/cache/nginx \
    && chown -R nginx:nginx /etc/nginx \
    && chmod -R 755 /etc/nginx

# Create log directories
RUN mkdir -p /var/log/nginx \
    && chown -R nginx:nginx /var/log/nginx

# Expose ports
EXPOSE 80 443

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=30s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# Use default nginx user

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]