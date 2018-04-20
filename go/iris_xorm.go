package main

import (
	"time"
	"github.com/kataras/iris"
	"github.com/go-xorm/xorm"
	//_ "github.com/mattn/go-sqlite3"
	_ "github.com/go-sql-driver/mysql"
)

type Usuario struct {
	ID        	int	  `xorm:"pk autoincr 'id'" json:"id"`
	Nome   	  	string 	  `xorm:"varchar(200) 'nome'" json:"nome"`
	Login     	string	  `xorm:"varchar(200) 'login'" json:"login"`
	Senha  		string    `xorm:"varchar(200) 'senha'" json:"senha"`
	Email  		string    `xorm:"varchar(200) 'email'" json:"email"`
	Permissao 	string    `xorm:"varchar(200) 'permissao'" json:"permissao"`
	CreatedAt 	time.Time `xorm:"created 'created_at'" json:"created_at"`
	UpdatedAt 	time.Time `xorm:"updated 'updated_at'" json:"updated_at"`
}

var orm *xorm.Engine

func list(c iris.Context) {
	var usuarios []Usuario
	orm.Find(&usuarios)
	c.JSON(usuarios)
}

func get(c iris.Context) {
	id := c.Params().Get("id")
	var usuario Usuario
	orm.Id(id).Get(&usuario)
	c.JSON(usuario)
}

func save(c iris.Context) {
	usuario := new(Usuario)
	c.ReadJSON(&usuario)
	orm.Insert(usuario)
	c.JSON(usuario)
}

func update(c iris.Context) {
	id := c.Params().Get("id")
	var usuario Usuario
	c.ReadJSON(&usuario)
	orm.Id(id).Update(&usuario)
	c.JSON(usuario)
}

func delete(c iris.Context) {
	id := c.Params().Get("id")
	orm.Id(id).Delete(&Usuario{})
	c.JSON("{}")
}

func main() {
	app := iris.New()

	var err error
    orm, err = xorm.NewEngine("mysql", "root:senha123@/eventos?charset=utf8")
	if err != nil {
		app.Logger().Fatalf("orm failed to initialized: %v", err)
	}

	iris.RegisterOnInterrupt(func() {
		orm.Close()
	})

	err = orm.Sync2(new(Usuario))

	if err != nil {
		app.Logger().Fatalf("orm failed to initialized Usuario table: %v", err)
	}

	app.Get("/usuarios", list)
	app.Post("/usuarios", save)
	app.Get("/usuarios/{id:int}", get)
	app.Put("/usuarios/{id:int}", update)
	app.Delete("/usuarios/{id:int}", delete)

	app.Run(iris.Addr(":8000"), iris.WithoutServerError(iris.ErrServerClosed))
}
