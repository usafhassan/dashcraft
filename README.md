# DashCraft - Filament Expertise Showcase

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-4.x-blue.svg)](https://filamentphp.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-orange.svg)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.x-38B2AC.svg)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

<div align="center">
  <img src="https://via.placeholder.com/800x400/3b82f6/ffffff?text=DashCraft+Filament+Showcase" alt="DashCraft Filament Showcase" width="800" height="400">
  <p><em>🚀 A comprehensive demonstration of advanced Filament development skills</em></p>
</div>

## 🎯 **Filament Expertise Portfolio**

This project serves as a **comprehensive showcase of advanced Filament development capabilities**, demonstrating proficiency in building sophisticated admin panels, custom resources, widgets, and complex business logic integration. Perfect for demonstrating Filament expertise to potential employers and clients.

**Built with Laravel 12, Filament 4, and Livewire** - showcasing the latest features and best practices in modern PHP admin panel development.

## 🖼️ **Live Demo Screenshots**

<div align="center">
  <img src="public/dashcraft-landing.png.png" alt="DashCraft Landing Page" width="100%" style="border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
  
  <br><br>
  
  <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
    <div style="text-align: center;">
      <img src="public/dashcraft-admin-dash.png" alt="Filament Dashboard" width="400" style="border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
      <p><strong>📊 Advanced Dashboard</strong><br>Real-time widgets & analytics</p>
    </div>
    <div style="text-align: center;">
      <img src="public/dashcraft-admin-personas.png" alt="Filament Resources" width="400" style="border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
      <p><strong>👥 Custom Resources</strong><br>Complex relationships & forms</p>
    </div>
  </div>
</div>

## 🚀 **Filament Skills Demonstrated**

### 🎯 **Advanced Filament Development**
- **📊 Custom Resources**: Sophisticated Customer, Persona, Tag, and User resources with complex relationships
- **📈 Dashboard Widgets**: Real-time analytics widgets with live data and interactive charts
- **🏷️ Smart Forms**: Multi-step forms with conditional fields and validation rules
- **👥 Advanced Tables**: Complex filtering, sorting, bulk actions, and custom column types
- **🔐 Filament Shield Integration**: Role-based permissions with granular access control

### 🎨 **Custom Filament Theme & UI**
- **🎨 Custom Theme**: Distinctive Filament theme showcasing design customization skills
- **📱 Responsive Design**: Mobile-first admin interface with seamless dark/light mode
- **⚡ Custom Components**: Tailored UI components and interactive elements
- **🎯 Professional Layout**: Clean, modern admin interface perfect for client demos

### 🚀 **Advanced Filament Features**
- **⚡ Filament 4 Latest**: Utilizing cutting-edge Filament 4 features and capabilities
- **🔧 Custom Actions**: Bulk operations, exports, and complex business logic
- **🛡️ Security Integration**: Filament Shield with role-based permissions
- **🔄 Livewire Integration**: Reactive components and real-time updates
- **📦 Production Ready**: Optimized for deployment with comprehensive configurations

## 🛠️ **Filament Technology Stack**

- **🎯 Core Framework**: Laravel 12.x (Latest LTS)
- **⚡ Admin Panel**: Filament 4.x (Cutting-edge features)
- **🔄 Reactive UI**: Livewire 3.x (Real-time components)
- **🎨 Styling**: Tailwind CSS 4.x (Modern utility-first CSS)
- **🗄️ Database**: SQLite (dev), MySQL/PostgreSQL (production)
- **🔐 Security**: Filament Shield (Role-based permissions)
- **🧪 Testing**: Pest PHP (Modern testing framework)
- **📏 Code Quality**: Laravel Pint, PHPStan (Professional standards)

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and NPM
- SQLite/MySQL/PostgreSQL

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ and NPM
- SQLite/MySQL/PostgreSQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/dashcraft.git
   cd dashcraft
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup with demo data**
   ```bash
   php artisan migrate
   php artisan db:seed --class=DemoDataSeeder
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

### 🎯 Demo Access

After seeding, you can access the application with these demo accounts:

- **Admin**: `admin@dashcraft.com` / `password`
- **Manager**: `manager@dashcraft.com` / `password`  
- **Viewer**: `viewer@dashcraft.com` / `password`

Visit `http://localhost:8000` for the welcome page or `http://localhost:8000/admin` for the admin panel.

## 📸 **Filament Admin Screenshots**

<div align="center">
  <h3>🎨 Professional Landing Page</h3>
  <img src="public/dashcraft-landing.png.png" alt="DashCraft Landing Page - Filament Expertise Showcase" width="800" height="400">
  <p><em>Modern, professional landing page showcasing Filament development capabilities</em></p>
  
  <h3>📊 Advanced Filament Dashboard</h3>
  <img src="public/dashcraft-admin-dash.png" alt="DashCraft Filament Admin Dashboard" width="800" height="400">
  <p><em>Sophisticated Filament admin dashboard with custom widgets and real-time analytics</em></p>
  
  <h3>👥 Customer Management Resources</h3>
  <img src="public/dashcraft-admin-personas.png" alt="DashCraft Customer Management with Personas" width="800" height="400">
  <p><em>Advanced Filament resources with complex relationships and custom form schemas</em></p>
</div>

## 🎯 **Filament Expertise Highlights**

### 1. **Advanced Filament Resources**
- **🏗️ Custom Resource Architecture**: Sophisticated Customer, Persona, Tag, and User resources
- **📊 Complex Relationships**: Many-to-many relationships with pivot table configurations
- **🔍 Advanced Filtering**: Custom filters, search, and sorting capabilities
- **⚡ Bulk Operations**: Mass actions with custom business logic integration

### 2. **Filament Dashboard & Widgets**
- **📈 Real-time Analytics**: Live dashboard widgets with dynamic data
- **📊 Interactive Charts**: Custom chart components with Filament integration
- **🎯 KPI Widgets**: Business intelligence widgets with real-time updates
- **📱 Responsive Dashboard**: Mobile-optimized admin interface

### 3. **Filament Forms & Validation**
- **🎨 Custom Form Schemas**: Multi-step forms with conditional logic
- **✅ Advanced Validation**: Complex validation rules and custom validators
- **🔄 Dynamic Fields**: Conditional field rendering based on user input
- **💾 Auto-save Functionality**: Real-time form data persistence

### 4. **Filament Security & Permissions**
- **🔐 Filament Shield Integration**: Role-based access control
- **👥 User Management**: Complete user administration with role assignment
- **🛡️ Resource Permissions**: Granular permissions for each resource
- **🔒 Secure Actions**: Protected operations with permission checks

## 📊 **Filament-Optimized Database Schema**

The application demonstrates advanced database design optimized for Filament admin panels:

- **👥 Users**: Authentication with Filament Shield role management
- **📊 Customers**: Core entity with complex Filament resource relationships
- **🎭 Personas**: Customer segmentation with Filament form schemas
- **🏷️ Tags**: Flexible tagging system with Filament table configurations
- **🔗 Pivot Tables**: Many-to-many relationships optimized for Filament displays

## 🧪 **Filament Testing Strategy**

The project demonstrates professional testing practices for Filament applications:

```bash
# Run all tests
php artisan test

# Run Filament-specific tests
php artisan test --filter=DashboardTest
php artisan test --filter=AuthenticationTest

# Test Filament resources
php artisan test --filter=CustomerTest
```

## 📈 **Filament Performance Optimizations**

- **🚀 Database Indexing**: Optimized queries for Filament table performance
- **⚡ Eager Loading**: N+1 query prevention in Filament resources
- **💾 Caching Strategy**: Strategic caching for Filament dashboard widgets
- **📦 Asset Optimization**: Minified CSS/JS with Vite bundling for Filament
- **🎨 Theme Optimization**: Optimized custom Filament theme performance

## 🔧 **Filament Development Environment**

- **⚡ Hot Reload**: Vite development server with Filament hot module replacement
- **📏 Code Quality**: Laravel Pint for Filament code formatting standards
- **🔍 Static Analysis**: PHPStan for Filament type checking
- **🪝 Git Hooks**: Pre-commit hooks for Filament code quality
- **🐳 Docker Support**: Containerized Filament development environment

## 📱 **Filament Responsive Design**

The Filament admin panel is fully responsive and optimized for:
- **🖥️ Desktop** (1024px+) - Full Filament feature set
- **📱 Tablet** (768px - 1023px) - Optimized Filament layout
- **📱 Mobile** (320px - 767px) - Touch-friendly Filament interface

## 🎨 **Custom Filament Design System**

Built with a sophisticated design system for Filament:
- **🎨 Color Palette**: Professional gradients optimized for Filament themes
- **📝 Typography**: Inter font family for modern Filament readability
- **📏 Spacing**: Consistent 8px grid system for Filament layouts
- **🧩 Components**: Reusable Filament UI components with Tailwind CSS

## 🚀 **Filament Production Deployment**

DashCraft demonstrates production-ready Filament deployment with comprehensive configurations and optimizations.

### 📋 Quick Production Setup

1. **Environment Configuration**
   ```bash
   cp .env.example .env
   # Configure production settings (see DEPLOYMENT.md)
   ```

2. **Database & Assets**
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=DemoDataSeeder
   npm run build
   php artisan optimize
   ```

3. **Performance Optimization**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   ```

### 📖 Complete Deployment Guide

For detailed production deployment instructions, server configurations, security settings, and monitoring setup, see our comprehensive **[DEPLOYMENT.md](DEPLOYMENT.md)** guide.

### 🐳 Docker Deployment

```bash
# Build and run with Docker Compose
docker-compose up -d

# Or build manually
docker build -t dashcraft .
docker run -p 8000:8000 dashcraft
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 **Filament Expertise Showcase**

This project serves as a **comprehensive demonstration of advanced Filament development skills**, showcasing:

- **🏗️ Complex Resource Architecture**
- **📊 Advanced Dashboard Widgets** 
- **🎨 Custom Filament Themes**
- **🔐 Filament Shield Integration**
- **⚡ Performance Optimizations**
- **🧪 Professional Testing Practices**

Perfect for demonstrating Filament expertise to potential employers, clients, and the Laravel community.

## 📞 **Contact & Collaboration**

For Filament development opportunities, consulting, or collaboration:
- **📧 Email**: usafhassan@gmail.com
- **💼 LinkedIn**: https://www.linkedin.com/in/usafhassan
- **🐙 GitHub**: Available for code review and collaboration

## 🙏 **Acknowledgments**

- **Laravel Team** - Amazing framework foundation
- **Filament Team** - Powerful admin panel that makes this showcase possible
- **Livewire Team** - Reactive components for dynamic interfaces
- **Tailwind CSS Team** - Utility-first CSS framework for beautiful designs

---

**🚀 Built with ❤️ to showcase advanced Filament development expertise**