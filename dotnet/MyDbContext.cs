using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;
using Eventos.Models;

namespace Eventos
{
    public partial class MyDbContext : DbContext
    {
        public virtual DbSet<Usuario> Usuarios { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. See http://go.microsoft.com/fwlink/?LinkId=723263 for guidance on storing connection strings.
                optionsBuilder.UseMySql("Server=localhost;User Id=root;Password=senha123;Database=eventos");
            }
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Usuario>(entity =>
            {
                entity.ToTable("usuarios");

                entity.Property(e => e.Id)
                    .HasColumnName("id")
                    .HasColumnType("bigint(20)");

                entity.Property(e => e.CreatedAt)
                    .HasColumnName("created_at")
                    .HasColumnType("datetime");

                entity.Property(e => e.Email)
                    .HasColumnName("email")
                    .HasMaxLength(200);

                entity.Property(e => e.Login)
                    .HasColumnName("login")
                    .HasMaxLength(200);

                entity.Property(e => e.Nome)
                    .HasColumnName("nome")
                    .HasMaxLength(200);

                entity.Property(e => e.Permissao)
                    .HasColumnName("permissao")
                    .HasMaxLength(200);

                entity.Property(e => e.Senha)
                    .HasColumnName("senha")
                    .HasMaxLength(200);

                entity.Property(e => e.UpdatedAt)
                    .HasColumnName("updated_at")
                    .HasColumnType("datetime");
            });
        }
    }
}
