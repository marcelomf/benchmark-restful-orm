class CreateUsuarios < ActiveRecord::Migration[5.2]
  def change
    create_table :usuarios do |t|
      t.string :nome
      t.string :login
      t.string :senha
      t.string :email
      t.string :permissao

      t.timestamps
    end
  end
end
