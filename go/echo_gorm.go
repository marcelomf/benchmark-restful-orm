package main

import (
  //"time"
  //"fmt"
	"net/http"	
  "github.com/labstack/echo"
  //"github.com/go-xorm/xorm"
  "github.com/jinzhu/gorm"
  //_ "github.com/mattn/go-sqlite3"
  _ "github.com/go-sql-driver/mysql"
)

type Usuario struct {
  ID        uint    `json:"id"`//
	Nome      string  `json:"nome"`//
	Login     string  `json:"login"`//
	Senha     string  `json:"senha"`// 
	Email     string  `json:"email"`// 
	Permissao string  `json:"permissao"`// 
}

func list(c echo.Context) error {
  var usuarios []Usuario
  orm.Find(&usuarios)
  return c.JSON(http.StatusOK, usuarios)
}

func get(c echo.Context) error {
  id := c.Param("id")
  var usuario Usuario
  orm.First(&usuario, id)
  return c.JSON(http.StatusOK, usuario)
}

func save(c echo.Context) error {
  usuario := new(Usuario)
  if err := c.Bind(usuario); err != nil {
		return err
  }
  orm.Create(&usuario)
  return c.JSON(http.StatusCreated, usuario)
}

func update(c echo.Context) error {
  id := c.Param("id")
  var usuario Usuario
  orm.First(&usuario, id)
  if err := c.Bind(&usuario); err != nil {
		return err
  }
  orm.Save(&usuario)
  return c.JSON(http.StatusOK, usuario)
}

func delete(c echo.Context) error {
  id := c.Param("id")
  var usuario Usuario
  orm.First(&usuario, id)
  orm.Delete(&usuario)
  return c.String(http.StatusOK, "{}")
}

var orm, errDb = gorm.Open("mysql", "root:senha123@tcp(localhost:3306)/eventos")

func main() {
  e := echo.New()

  if errDb != nil {
		e.Logger.Fatal("orm failed to initialized: %v", errDb)
  }
  
  orm.AutoMigrate(&Usuario{})
  orm.DB().SetMaxIdleConns(50)
  orm.DB().SetMaxOpenConns(150)

	e.GET("/", func(c echo.Context) error {
		return c.String(http.StatusOK, "Hello, World!")
  })

  e.GET("/usuarios", list)
  e.POST("/usuarios", save)
  e.GET("/usuarios/:id", get)
  e.PUT("/usuarios/:id", update)
  e.DELETE("/usuarios/:id", delete)
  
	e.Logger.Fatal(e.Start(":8000"))
}