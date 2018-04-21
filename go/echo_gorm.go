package main

import (
  "time"
	"net/http"	
  "github.com/labstack/echo"
  "github.com/jinzhu/gorm"
  _ "github.com/go-sql-driver/mysql"
)

type Usuario struct {
  ID        uint    `gorm:"column:id" json:"id"`
	Nome      string  `gorm:"column:nome" json:"nome"`
	Login     string  `gorm:"column:login" json:"login"`
	Senha     string  `gorm:"column:senha" json:"senha"` 
	Email     string  `gorm:"column:email" json:"email"` 
  Permissao string  `gorm:"column:permissao" json:"permissao"` 
  CreatedAt 	time.Time `gorm:"column:created_at" json:"created_at"`
	UpdatedAt 	time.Time `gorm:"column:updated_at" json:"updated_at"`
}

func List(c echo.Context) error {
  var usuarios []Usuario
  orm.Find(&usuarios)
  return c.JSON(http.StatusOK, usuarios)
}

func Get(c echo.Context) error {
  id := c.Param("id")
  var usuario Usuario
  orm.First(&usuario, id)
  return c.JSON(http.StatusOK, usuario)
}

func Save(c echo.Context) error {
  usuario := new(Usuario)
  if err := c.Bind(usuario); err != nil {
		return err
  }
  orm.Create(&usuario)
  return c.JSON(http.StatusCreated, usuario)
}

func Update(c echo.Context) error {
  id := c.Param("id")
  var usuario Usuario
  orm.First(&usuario, id)
  if err := c.Bind(&usuario); err != nil {
		return err
  }
  orm.Save(&usuario)
  return c.JSON(http.StatusOK, usuario)
}

func Delete(c echo.Context) error {
  id := c.Param("id")
  var usuario Usuario
  orm.First(&usuario, id)
  orm.Delete(&usuario)
  return c.String(http.StatusOK, "{}")
}

var orm *gorm.DB;

func main() {
  e := echo.New()

  orm, errDb := gorm.Open("mysql", "root:senha123@tcp(localhost:3306)/eventos")

  if errDb != nil {
		e.Logger.Fatal("orm failed to initialized: %v", errDb)
  }
  
  orm.AutoMigrate(&Usuario{})
  orm.DB().SetMaxIdleConns(50)
  orm.DB().SetMaxOpenConns(150)

	e.GET("/", func(c echo.Context) error {
		return c.String(http.StatusOK, "Hello, World!")
  })

  e.GET("/usuarios", List)
  e.POST("/usuarios", Save)
  e.GET("/usuarios/:id", Get)
  e.PUT("/usuarios/:id", Update)
  e.DELETE("/usuarios/:id", Delete)
  
	e.Logger.Fatal(e.Start(":8000"))
}